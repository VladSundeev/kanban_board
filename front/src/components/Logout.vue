<template>
  <button @click="logout">Logout</button>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const router = useRouter();

    const logout = async () => {
      try {
        await axios.post('http://127.0.0.1:8000/api/logout');
        localStorage.removeItem('user');
        router.push('/login');
      } catch (error) {
        console.error('Error logging out:', error);
      }
    };

    return {
      logout
    };
  }
};
</script>
