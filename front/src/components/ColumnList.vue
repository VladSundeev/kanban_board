<template>
  <div>
    <h1>Task Board</h1>
    <router-link to="/add-column">
      <button>Add New Column</button>
    </router-link>
    <router-link to="/add-task">
      <button>Add New Task</button>
    </router-link>
    <div class="columns">
      <div v-for="column in columns" :key="column.id" class="column">
        <h2>{{ column.name }}</h2>
        <div v-for="task in column.tasks" :key="task.id" class="task">
          <h3>{{ task.title }}</h3>
          <p>{{ task.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  name: 'TaskBoard',
  setup() {
    const columns = ref([]);

    const fetchColumns = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/columns');
        columns.value = response.data;
      } catch (error) {
        console.error('Error fetching columns:', error);
      }
    };

    onMounted(() => {
      fetchColumns();
    });

    return {
      columns,
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
