<template>
  <div>
    <h1>Register</h1>
    <input v-model="name" placeholder="Name" />
    <input v-model="email" placeholder="Email" />
    <input v-model="password" type="password" placeholder="Password" />
    <input v-model="password_confirmation" type="password" placeholder="Confirm Password" />
    <button @click="register">Register</button>
  </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'UserRegister',
  setup() {
    const name = ref('');
    const email = ref('');
    const password = ref('');
    const password_confirmation = ref('');
    const router = useRouter();

    const register = async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/register', {
          name: name.value,
          email: email.value,
          password: password.value,
          password_confirmation: password_confirmation.value,
        });

        localStorage.setItem('user', JSON.stringify(response.data.user));
        router.push('/');
      } catch (error) {
        console.error('Error registering:', error);
      }
    };

    return {
      name,
      email,
      password,
      password_confirmation,
      register
    };
  }
};
</script>
