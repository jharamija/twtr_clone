import axios from 'axios';
window.axios = axios;

// let user_token = $('meta[name="user-token"]').attr('content');

// Vue.http.interceptors.push((request, next) => {
//     request.headers.set('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
//     next();
//  });

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common['Authorisation'] = `Bearer ${user_token}`;
