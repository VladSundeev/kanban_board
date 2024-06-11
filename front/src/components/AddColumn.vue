<template>
  <div>
    <h1>Add New Column</h1>
    <input v-model="newColumnName" placeholder="Enter column name" />
    <button @click="addColumn">Add Column</button>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  name: 'AddColumn',
  setup() {
    const newColumnName = ref('');
    const router = useRouter();

    const addColumn = async () => {
      if (newColumnName.value.trim() !== '') {
        try {
          await axios.post('http://127.0.0.1:8000/api/columns', {
            name: newColumnName.value,
            tasks: []
          });
          router.push('/');
        } catch (error) {
          console.error('Error adding column:', error);
        }
      }
    };

    return {
      newColumnName,
      addColumn
    };
  }
};
</script>
