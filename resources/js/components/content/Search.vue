<template>
  <div>
    <navs></navs>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">Showing result for {{this.$route.query.q}}</div>
        <div id v-for="datas in data" :key="datas.id">
          <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-2">
                <img :src="'/uploads/'+datas.thumbnail" height="200" width="180">
              </div>
              <div class="col-md-10">
                <div class="card-body">
                  <h5 class="card-title">{{datas.title}}</h5>
                  <p
                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis"
                    class="card-text"
                  >{{datas.synopsis}}</p>
                  <p class="card-text">
                    <small class="text-muted">Last updated on {{datas.updated_at}}</small>
                  </p>
                  <router-link class="btn btn-primary" :to="'/read/'+datas.id">Read More</router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ContentNav from "./Nav.vue";
export default {
  components: {
    navs: ContentNav
  },
  data() {
    return {
      data: []
    };
  },
  created() {
    this.loadContent();
  },
  methods: {
    loadContent() {
      axios
        .get(this.animeapi+"contents/search/query?q="+this.$route.query.q)
        .then(response => {
          this.data = response.data.result;
        });
    }
  }
};
</script>