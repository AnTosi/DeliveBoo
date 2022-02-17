/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { words, forEach } = require('lodash');

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

           filterTags: [],
       }
    },

    methods: {
        tagHandler(e) {
            //console.log(e.target);
            this.tag = e.target.innerHTML
          
            if(!this.filterTags.includes(this.tag)) {

                this.filterTags.push(this.tag);

                /* console.log(this.tag);
                console.log(this.filterTags); */
            }
            else {
                let index = this.filterTags.indexOf(this.tag) 

                if(index > -1) {

                    this.filterTags.splice(index, 1);
                    /* console.log(this.filterTags); */
                }

            }

            console.log(this.filteredUsers);

        },

    },

    mounted() {
        axios.get('/api/users')
        .then((r) => {
            //console.log(r.data.data);
            this.users = r.data.data
        })

    },

    /* clothes = clothes.filter(function (element) {
  // includes checks if the element exist on the array it was called on
  return clothesFilters.includes(element);
}); */
    computed: {
        filteredUsers() {
          
            let ristoranti = []

            if(this.filterTags.length > 0) {

                this.users.forEach((rest) => {
                    rest.tags.forEach((tag) => {
                        if(this.filterTags.includes(tag.name)) {
                            if(!ristoranti.includes(rest)) {

                                ristoranti.push(rest)
                            }
                        }
                    })
                })

            }



            return ristoranti

        }
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



