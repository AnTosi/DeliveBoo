/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { words, forEach, indexOf } = require('lodash')

require('./bootstrap')

window.Vue = require('vue')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
  'example-component',
  require('./components/ExampleComponent.vue').default,
)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',

  data() {
    return {
      users: null,

      tag: '',

      filterTags: [],

      tags: null,

      searchInput: '',
    }
  },

  methods: {
    tagHandler(tag) {
      this.tag = tag

      if (!this.filterTags.includes(tag)) {
        this.filterTags.push(tag)
      } else {
        let index = this.filterTags.indexOf(tag)

        if (index > -1) {
          this.filterTags.splice(index, 1)
        }
      }
    },
  },

  mounted() {
    axios.get('/api/users').then((r) => {
      this.users = r.data.data
    })
    axios.get('/api/tags').then((r2) => {
      this.tags = r2.data.data
      console.log(this.tags)
    })
  },

  computed: {
    filteredUsers() {
      let restaurants = []
      if (this.users) {
        restaurants = this.users
      }
      let filters = this.filterTags

      filteredRestaurants = []

      if (restaurants) {
        filters.forEach((filter) => {
          for (let i = 0; i < restaurants.length; i++) {
            const restaurant = restaurants[i]

            if (restaurant.tags.some((rest) => rest.name === filter)) {
              if (!filteredRestaurants.includes(restaurant))
                filteredRestaurants.push(restaurant)
            } else if (
              !restaurant.tags.some((rest) => rest.name === filter) &&
              filteredRestaurants.includes(restaurant)
            ) {
              filteredRestaurants.splice(i, 1)
            }
          }
        })
      }

      // console.log(restaurants);

      return filteredRestaurants
    },

    // console.log(restaurants);
    filteredList() {
      if (this.users) {
        return this.users.filter((user) => {
          return user.name
            .toLowerCase()
            .includes(this.searchInput.trim().toLowerCase())
        })
      }
    },
  },
})

var password = document.getElementById('password')
var toggler = document.getElementById('toggler')
showHidePassword = () => {
  if (password.type == 'password') {
    password.setAttribute('type', 'text')
    toggler.classList.add('fa-eye-slash')
  } else {
    toggler.classList.remove('fa-eye-slash')
    password.setAttribute('type', 'password')
  }
}
toggler.addEventListener('click', showHidePassword)
