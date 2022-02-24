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

      indexDish: [],

      currentPage: 1,

      displayedDishesLength: null,

      localDishes: [],

      previousPage: null,

      lastPage: null,

      filteredRest: [],

      filteredUsers: [],

      qty: 1,
    }
  },

  methods: {


    tagHandler(tag) {
      this.tag = tag.id
      if (!this.filterTags.includes(this.tag)) {
        this.filterTags.push(this.tag)
      } else {
        let index = this.filterTags.indexOf(this.tag)

        if (index > -1) {
          this.filterTags.splice(index, 1)
        }
      }
      if (this.filterTags.length > 0) {
        axios.get('/api/tag/' + [this.filterTags]).then((r) => {
          this.filteredUsers = r.data
        })
      } else {
        this.filteredUsers = 0
      }

      // this.callApi()
    },


    addToCart(dish) {
      //localStorage.clear()
      if (localStorage.getItem('localDish') == null) {
        localStorage.setItem('localDish', '[]')
      }
      this.cart = JSON.parse(localStorage.getItem('localDish'))

      if (localStorage.getItem('dish' + JSON.stringify(dish.id)) == null) {
        localStorage.setItem(
          'dish' + JSON.stringify(dish.id),
          JSON.stringify(dish),
        )
        let Dish = JSON.parse(
          localStorage.getItem('dish' + JSON.stringify(dish.id)),
        )
        this.cart.push(Dish)
        localStorage.setItem('localDish', JSON.stringify(this.cart))
      }
    },
    removeCart(dish) {
      let Dish = JSON.parse(
        localStorage.getItem('dish' + JSON.stringify(dish.id)),
      )

      for (let index = 0; index < this.cart.length; index++) {
        if (this.cart[index].id == Dish.id) {
          localStorage.removeItem('dish' + JSON.stringify(dish.id))
          this.cart.splice(index, 1)
          localStorage.setItem('localDish', JSON.stringify(this.cart))
        }
      }

      //console.log(this.cart)
    },

    next() {
      if (this.currentPage == this.lastPage) {
        this.currentPage = 1
      } else {
        this.currentPage++
      }

      axios.get('/api/users?page=' + this.currentPage).then((r) => {
        this.users = r.data.data
      })
    },

    prev() {
      if (this.currentPage == 1) {
        this.currentPage = this.lastPage
      } else {
        this.currentPage--
      }

      axios.get('/api/users?page=' + this.currentPage).then((r) => {
        this.users = r.data.data
      })
    },

    current(page) {
      this.currentPage = page
      axios.get('/api/users?page=' + this.currentPage).then((r) => {
        this.users = r.data.data
      })
    },
    filteredList() {

      if (this.searchInput) {
        axios.get('api/user/' + this.searchInput).then((r) => {
          if (!this.filteredRest.includes(r.data)) {

            this.filteredRest = r.data
          }

        })

      } else {
        this.filteredRest = 0
      }

    },
  },

  mounted() {
    axios.get('/api/users?page=1').then((r) => {
      this.users = r.data.data
      this.currentPage = r.data.meta.current_page
      this.previousPage = r.data.meta.from
      this.lastPage = r.data.meta.last_page
    })

    if (localStorage.localDish) {
      this.cart = JSON.parse(localStorage.localDish)
    }
  },

  computed: {


    displayedDishes() {
      let dishes = this.user.dishes.filter((dish) => dish.visibility == true)
      this.displayedDishesLength = dishes.length()
      return this.paginate(dishes)
    },
  },

  watch: {
    dishes() {
      this.setPages()
    },
  },

  filters: {
    trimWords(value) {
      return value.split(' ').splice(0, 20).join(' ') + '...'
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





