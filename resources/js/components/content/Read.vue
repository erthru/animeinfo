<template>
  <div>
    <navs></navs>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="row">
            <div class="col-md-3">
              <img src="#" id="imgThumbnail" class="card-img-top">
            </div>
            <div class="col-md-9">
              <div class="card-body">
                <h3 class="card-title" id="h3Title">Loading title...</h3>
                <router-link :to="'/content/studio/'+studio_id"><h6 class="card-subtitle mb-2 text-muted" id="h6StudioName"></h6></router-link>
                <p
                  class="card-text"
                  id="pSynopsis"
                >Loading synopsis...</p>
                <br>
                <small class="card-subtitle mb-2 text-muted" id="pUpdatedAt"></small>
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
  data(){
    return{
      studio_id: ""
    }
  },
  created() {
    this.loadContentDetail();
  },
  methods: {
    loadContentDetail() {
      axios
        .get(this.animeapi+"contents/" + this.$route.params.id)
        .then(response => {
          console.log(response.data.result);
          $("#imgThumbnail").attr(
            "src",
            "/uploads/" + response.data.result.thumbnail
          );
          $("#h3Title").text(response.data.result.title);
          $("#h6StudioName").text(response.data.result.studio.name);
          $("#pSynopsis").text(response.data.result.synopsis);
          $("#pUpdatedAt").text('last updated on '+response.data.result.updated_at);
          this.studio_id = response.data.result.studio.id;
        });
    }
  }
};
</script>