<template>
  <div>
    <h1>Login</h1>
    <input v-model="email" placeholder="Email" />
    <input v-model="password" type="password" placeholder="Password" />
    <button @click="login">Login</button>
  </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'UserLogin',
  setup() {
    const email = ref('');
    const password = ref('');
    const router = useRouter();

    const login = async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: email.value,
          password: password.value,
        });

        localStorage.setItem('user', JSON.stringify(response.data));
        router.push('/');
      } catch (error) {
        console.error('Error logging in:', error);
      }
    };

    return {
      email,
      password,
      login
    };
  }
};
</script>
