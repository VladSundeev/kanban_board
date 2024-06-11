<template>
  <div>
    <h1>Add New Task</h1>
    <input v-model="taskTitle" placeholder="Enter task title" />
    <input v-model="taskDescription" placeholder="Enter task description" />
    <select v-model="selectedColumnId">
      <option v-for="column in columns" :key="column.id" :value="column.id">{{ column.name }}</option>
    </select>
    <button @click="addTask">Add Task</button>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  name: 'AddTask',
  setup() {
    const taskTitle = ref('');
    const taskDescription = ref('');
    const selectedColumnId = ref('');
    const columns = ref([]);
    const router = useRouter();

    const fetchColumns = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/columns');
        columns.value = response.data;
      } catch (error) {
        console.error('Error fetching columns:', error);
      }
    };

    const addTask = async () => {
      if (taskTitle.value.trim() !== '' && selectedColumnId.value !== '') {
        try {
          await axios.post('http://127.0.0.1:8000/api/tasks', {
            title: taskTitle.value,
            description: taskDescription.value,
            column_id: selectedColumnId.value
          });
          router.push('/');
        } catch (error) {
          console.error('Error adding task:', error);
        }
      }
    };

    onMounted(() => {
      fetchColumns();
    });

    return {
      taskTitle,
      taskDescription,
      selectedColumnId,
      columns,
      addTask
    };
  }
};
</script>
