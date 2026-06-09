import './bootstrap';

// Ya no necesitas importar, axios está global
window.axios.get('/sanctum/csrf-cookie').then(response => {
    window.axios.post("/api/user/login", {
        email: 'oscar@gmail.com',
        password: '123456789',
    }).then((res) => {
        console.log(res.data);        
    }).catch((error) => {
        console.log(error.response?.data || error);            
    });
});

window.axios.get('/sanctum/csrf-cookie').then(response => {
    window.axios.get('/api/user').then(response => {
        console.log(response.data)
    });
});