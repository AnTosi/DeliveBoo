<template>
  <div class="prova">
        <div v-for="restaurant in restaurants" :key="restaurant.id" class="col">
           
                <div class="card" aria-hidden="true">
                    <img style="width: 200px; height: 200px; object-fit: cover" class="card-img-top"
                        :src="'/storage/restaurant_image' + '/' + restaurant.id + '/' + restaurant.image " alt="">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="capitalize">{{ restaurant.name }}</span>
                        </h5>
                        <p>
                            {{ restaurant.address }}
                        </p>
                        <span v-for="tag in restaurant.tags" :key="tag.id">
                            {{ tag.name }}
                        </span>
                    </div>
                </div>
           
        </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            restaurants: '',
        }
    },
   
    mounted() {
        axios.get('/api/users')
        .then((r) => {
            console.log(r.data.data);
            this.restaurants = r.data.data
        })

    }
}
</script>

<style>

</style>