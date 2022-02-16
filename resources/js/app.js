/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { words } = require('lodash');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data() {
       return{
           users: null,
           tag: '',

           tags: [],
       }
    },

    methods: {
        tag(e) {
            //console.log(e.target);
            this.tag = e.target.innerHTML
          
            if(!this.tags.includes(this.tag)) {

                this.tags.push(this.tag);

                console.log(this.tags);
            }
            else {
                this.tags.splice(this.tag, 1)
                console.log(this.tags);
            }
        }
    },

    mounted() {
        axios.get('/api/users')
        .then((r) => {
            //console.log(r.data.data);
            this.users = r.data.data
        })

    }
});

var password = document.getElementById('password');
var toggler = document.getElementById('toggler');
showHidePassword = () => {
if (password.type == 'password') {
password.setAttribute('type', 'text');
toggler.classList.add('fa-eye-slash');
} else {
toggler.classList.remove('fa-eye-slash');
password.setAttribute('type', 'password');
}
};
toggler.addEventListener('click', showHidePassword);



