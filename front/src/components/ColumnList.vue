<template>
  <div>
    <h1>Task Board</h1>
    <input type="text" v-model="searchQuery" placeholder="Search tasks">

    <router-link to="/add-column">
      <button>Add New Column</button>
    </router-link>
    <router-link to="/add-task">
      <button>Add New Task</button>
    </router-link>
    <div class="columns">
      <div v-for="column in filteredColumns" :key="column.id" class="column"
           @dragover.prevent
           @drop="onDrop(column.id)">
        <h2>{{ column.name }}</h2>
        <div class="task"
             v-for="task in column.tasks"
             :key="task.id"
             :draggable="true"
             @dragstart="onDragStart(task, column.id)">
          <h3>{{ task.title }}</h3>
          <p>{{ task.description }}</p>
          <p>{{ task.user.name }}</p>
          <p>{{ formatDate(task.created_at) }}</p>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

export default {
  name: 'TaskBoard',
  setup() {
    const columns = ref([]);
    const searchQuery = ref('');

    const fetchColumns = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/columns');
        columns.value = response.data;
      } catch (error) {
        console.error('Error fetching columns:', error);
      }
    };

    const filteredColumns = computed(() => {
      return columns.value.map(column => ({
        ...column,
        tasks: column.tasks.filter(task => {
          return task.title.toLowerCase().includes(searchQuery.value.toLowerCase());
        })
      }));
    });

    const draggedTask = ref(null);
    const fromColumnId = ref(null);

    const onDragStart = (task, columnId) => {
      draggedTask.value = task;
      fromColumnId.value = columnId;
    };

    const onDrop = async (toColumnId) => {
      if (draggedTask.value && fromColumnId.value !== toColumnId) {
        const taskId = draggedTask.value.id;
        const fromColumn = columns.value.find(column => column.id === fromColumnId.value);
        const toColumn = columns.value.find(column => column.id === toColumnId);
        if (fromColumn && toColumn) {
          const index = fromColumn.tasks.findIndex(task => task.id === taskId);
          if (index !== -1) {
            draggedTask.value.column_id = toColumnId;
            fromColumn.tasks.splice(index, 1);
            toColumn.tasks.push(draggedTask.value);
            await saveChanges(taskId, toColumnId);
          }
        }
      }
      draggedTask.value = null;
      fromColumnId.value = null;
    };

    const saveChanges = async (taskId, toColumnId) => {
      try {
        const data = {
          task_id: taskId,
          column_id: toColumnId
        };

        await axios.post('http://127.0.0.1:8000/api/update-task', data);

        console.log('Changes saved successfully!');
      } catch (error) {
        console.error('Error saving changes:', error);
      }
    };

    onMounted(() => {
      fetchColumns();
    });

    const formatDate = (dateString) => {
      const date = new Date(dateString);
      const day = date.getDate().toString().padStart(2, '0');
      const month = (date.getMonth() + 1).toString().padStart(2, '0');
      const year = date.getFullYear();
      return `${day}-${month}-${year}`;
    };

    return {
      columns,
      searchQuery,
      filteredColumns,
      onDragStart,
      onDrop,
      formatDate,
    };
  },
};
</script>

<style>
.columns {
  display: flex;
}

.column {
  margin-right: 20px;
  border: 1px solid #ccc;
  padding: 10px;
}

.task {
  border: 1px solid #ccc;
  padding: 10px;
  margin-top: 10px;
}
</style>

