import axios from 'axios';

// Add a request interceptor
axios.interceptors.request.use(
  function (config) {
    // Retrieve the token from the Vuex store
    const token = localStorage.getItem('token');

    // If the token exists, add it to the Authorization header
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
  },
  function (error) {
    return Promise.reject(error);
  }
);