/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { indexOf } = require('lodash')

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

      cart: [],

      user: '',

      page: 1,

      perPage: 2,

      pages: [],

      displayedDishesLength: null,

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
    getUser(user) {
      this.user = user
      localStorage.setItem('user', JSON.stringify(this.user))
    },

    /* pagination */
    setPages() {
      let numberOfPages = Math.ceil(this.displayedDishesLength / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate(dishes) {
      let page = this.page;
      let perPage = this.perPage;
      let from = (page * perPage) - perPage;
      let to = (page * perPage);
      return dishes.slice(from, to);;
    },
    addToCart(dish) {
      if (!this.cart.includes(dish)) {
        this.cart.push(dish)
      }
    },
    removeCart(dish) {
      this.cart.splice(indexOf(this.cart, dish), 1)
    },

    nextPage() {
      if (this.pages.length == 0) {
        this.setPages()
      }
      if (this.page < this.pages.length) {
        this.page++
      }
    },

    activePage(pageNumber) {
      if (pageNumber == this.page) {
        return true
      }
    }


  },

  mounted() {
    axios.get('/api/users').then((r) => {
      this.users = r.data.data
    })
    axios.get('/api/tags').then((r2) => {
      this.tags = r2.data.data
    })

    if (localStorage.user) {
      this.user = JSON.parse(localStorage.user)
    }
  },

  computed: {
    filteredUsers() {
      let restaurants = []
      if (this.users) {
        restaurants = this.users
      }
      let filters = this.filterTags

      filteredRestaurants = []

      checkedFilters = []

      if (restaurants) {
        filters.forEach((filter) => {
          for (let i = 0; i < restaurants.length; i++) {
            const restaurant = restaurants[i]

            if (restaurant.tags.some((tag) => tag.name === filter)) {
              if (!filteredRestaurants.includes(restaurant)) {
                filteredRestaurants.push(restaurant)
              }
            }
          }
        })

        filters.forEach((filter) => {
          for (let i = 0; i < filteredRestaurants.length; i++) {
            const filteredRestaurant = filteredRestaurants[i]

            if (!filteredRestaurant.tags.some((tag) => tag.name === filter)) {
              filteredRestaurants.splice(i, 1)
            }
          }
        })

        for (let i = 0; i < filteredRestaurants.length; i++) {
          const filteredRestaurant = filteredRestaurants[i]

          filters.forEach((filter) => {
            if (!filteredRestaurant.tags.some((tag) => tag.name === filter)) {
              filteredRestaurants.splice(i, 1)
            }
          })
        }
        return filteredRestaurants
      }
    },

    filteredList() {
      if (this.users) {
        return this.users.filter((user) => {
          return user.name
            .toLowerCase()
            .includes(this.searchInput.trim().toLowerCase())
        })
      }
    },

    displayedDishes() {
      let dishes = this.user.dishes.filter(dish => dish.visibility == true);
      this.displayedDishesLength = dishes.length;
      return this.paginate(dishes);
    }
  },

  watch: {
    dishes() {
      this.setPages();
    }
  },

  filters: {
    trimWords(value) {
      return value.split(" ").splice(0, 20).join(" ") + '...';
    }
  }
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
