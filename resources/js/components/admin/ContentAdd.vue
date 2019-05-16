<template>
  <div>
    <div class="row">
      <div class="col-md-3">
        <sidebar></sidebar>
      </div>
      <div class="col-md-9">
        <br>
        <h3>Content Add</h3>
        <div class="row">
          <div class="col-md-6">
            <form @submit.prevent="addContent()">
              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input class="form-control" id="txTitle" placeholder="Title" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Synopsis</label>
                <textarea class="form-control" id="txSynopsis" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect2">Select Studio</label>
                <select class="form-control" id="optionStudio">
                  <option
                    v-for="studios in studio"
                    :key="studios.id"
                    :value="studios.id"
                  >{{studios.name}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlFile1">Upload thumbnail</label>
                <input type="file" class="form-control-file" id="fileThumbnail">
              </div>
              <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
            </form>
            <div
              class="alert alert-danger"
              id="alertErrorThumbnail"
              role="alert"
              hidden
            >Please select thumbnail</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminSidebar from "./Sidebar.vue";
export default {
  components: {
    sidebar: AdminSidebar
  },
  data() {
    return {
      studio: []
    };
  },
  created() {
    this.loadStudio();
  },
  methods: {
    loadStudio() {
      axios
        .get(this.animeapi+"studios/no_paging")
        .then(response => {
          this.studio = response.data.result;
        });
    },
    addContent() {
      $("#alertErrorThumbnail").attr("hidden", "");
      if ($("#fileThumbnail").prop("files")[0] == null) {
        $("#alertErrorThumbnail").removeAttr("hidden");
      } else {
        $("#btnSubmit")
          .text("Submitting....")
          .attr("disabled", "");
        let data = new FormData();
        data.append("title", $("#txTitle").val());
        data.append("synopsis", $("#txSynopsis").val());
        data.append("studio_id", $("#optionStudio").find(":selected").val());
        data.append("thumbnail", $("#fileThumbnail").prop("files")[0]);
        axios
          .post(
            this.animeapi+"contents",
            data,
            {
              headers: {
                "content-type": "multipart/form-data"
              }
            }
          )
          .then(response => {
            this.$router.push("/admin/content");
          })
          .catch(error => {
            console.log(error.response.data);
          });
      }
    }
  }
};
</script>
