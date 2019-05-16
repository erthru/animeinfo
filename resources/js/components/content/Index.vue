<template>
  <div>
    <navs></navs>
    <br>
    <div class="row">
      <div class="col-md-12">
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
        <nav aria-label="...">
          <ul class="pagination">
            <li class="page-item disabled" id="pagePrevious">
              <a class="page-link" href="#" v-on:click="page-=1; loadContent()">Previous</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link">Page {{page}} of {{totalPage}}</a>
            </li>
            <li class="page-item" id="pageNext">
              <a class="page-link" href="#" v-on:click="page+=1; loadContent()">Next</a>
            </li>
          </ul>
        </nav>
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
      data: [],
      page: 1,
      totalPage: 0
    };
  },
  created() {
    this.loadContent();
  },
  methods: {
    loadContent() {
      axios
        .get(this.animeapi+"contents?page=" + this.page)
        .then(response => {
          this.data = response.data.result.data;
          this.setPaging(
            response.data.result.current_page,
            response.data.result.last_page
          );
          this.totalPage = response.data.result.last_page;
        });
    },
    setPaging(current, last) {
      if (current == 1) {
        $("#pagePrevious").attr("class", "page-item disabled");
      } else {
        $("#pagePrevious").attr("class", "page-item");
      }
      if (current == last) {
        $("#pageNext").attr("class", "page-item disabled");
      } else {
        $("#pageNext").attr("class", "page-item");
      }
    }
  }
};
</script>