<template>
  <div>
    <div class="row">
      <div class="col-md-3">
        <sidebar></sidebar>
      </div>
      <div class="col-md-9">
        <br>
        <h3>Content List</h3>
        <div class="row">
          <div class="col-md-10">
            <form class="form-inline my-2 my-lg-0" @submit.prevent="searchContent()">
              <input
                class="form-control mr-sm-2"
                type="search"
                id="txSearch"
                placeholder="Search"
                aria-label="Search"
              >
              <button class="btn btn-outline-success">Search</button>
            </form>
          </div>
          <div class="col-md-2">
            <router-link class="btn btn-success w-100" to="/admin/content/add">+ Add</router-link>
          </div>
        </div>
        <br>
        <div class="alert alert-success" role="alert" id="alertSearch" hidden></div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Synopsis</th>
              <th scope="col">Studio</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="datas in data" :key="datas.id">
              <td>{{datas.title}}</td>
              <td
                style="max-width: 550px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"
              >{{datas.synopsis}}</td>
              <td>{{datas.studio.name}}</td>
              <td>
                <router-link class="btn btn-warning" :to="'/admin/content/read/'+datas.id">Details</router-link>
              </td>
            </tr>
          </tbody>
        </table>
        <nav aria-label="..." id="navPaging" hidden>
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
import AdminSideBar from "./Sidebar.vue";
export default {
  components: {
    sidebar: AdminSideBar
  },
  data() {
    return {
      data: [],
      page: 1,
      totalPage: 0
    };
  },
  created() {
    if (localStorage.getItem("id") == null) {
      this.$router.push("/admin/login");
    }
    this.loadContent();
  },
  methods: {
    loadContent() {
      axios.get(this.animeapi + "contents?page=" + this.page).then(response => {
        this.data = response.data.result.data;
        this.setPaging(
          response.data.result.current_page,
          response.data.result.last_page
        );
        this.totalPage = response.data.result.last_page;
        $("#navPaging").removeAttr("hidden");
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
    },
    searchContent() {
      if ($("#txSearch").val() == "") {
        $("#alertSearch").attr("hidden", "");
        this.loadContent();
      } else {
        $("#alertSearch")
          .removeAttr("hidden")
          .text("Showing result for " + $("#txSearch").val());
        axios
          .get(
            this.animeapi + "contents/search/query?q=" + $("#txSearch").val()
          )
          .then(response => {
            this.data = response.data.result;
            $("#navPaging").attr("hidden", "");
          });
      }
    }
  }
};
</script>
