<template>
  <div>
    <div class="row">
      <div class="col-md-3">
        <sidebar></sidebar>
      </div>
      <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">Delete this data ?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button
                type="button"
                id="btnDelete"
                data-dismiss="modal"
                v-on:click="deleteContent()"
                class="btn btn-danger"
              >Delete</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <br>
        <h3>Content Update</h3>
        <div class="row">
          <div class="col-md-6">
            <form @submit.prevent="updateContent()">
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
                <label for="exampleFormControlFile1">Tap image to change thumbnail</label>
                <br>
                <div class="spinner-border text-primary" id="loading" role="status" hidden>
                  <span class="sr-only">Loading...</span>
                </div>
                <img
                  src="#"
                  id="imgThumbnail"
                  onclick="$('#fileThumbnail').click()"
                  height="200"
                  width="150"
                >
                <input type="file" id="fileThumbnail" @change="updateThumbnail()" hidden>
              </div>
              <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
              <button
                type="button"
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#modalDelete"
                id="btnDeletePrepare"
              >Delete this data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminSidebar from "./Sidebar.vue";
import { setTimeout } from "timers";
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
    this.loadDetail();
  },
  methods: {
    loadStudio() {
      axios.get(this.animeapi + "studios/no_paging").then(response => {
        this.studio = response.data.result;
      });
    },
    updateContent() {
      $("#btnSubmit")
        .text("Submitting....")
        .attr("disabled", "");
      axios
        .put(this.animeapi + "contents/" + this.$route.params.id, {
          title: $("#txTitle").val(),
          synopsis: $("#txSynopsis").val(),
          studio_id: $("#optionStudio")
            .find(":selected")
            .val()
        })
        .then(response => {
          this.$router.push("/admin/content");
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },
    loadDetail() {
      let id = this.$route.params.id;
      axios.get(this.animeapi + "contents/" + id).then(response => {
        $("#txTitle").val(response.data.result.title);
        $("#txSynopsis").val(response.data.result.synopsis);
        $("#imgThumbnail").attr(
          "src",
          "/uploads/" + response.data.result.thumbnail
        );
        console.log($("#optionStudio").val());
      });
    },
    updateThumbnail() {
      $("#loading").removeAttr("hidden");
      $("#imgThumbnail").attr("hidden", "");
      let data = new FormData();
      data.append("thumbnail", $("#fileThumbnail").prop("files")[0]);
      axios
        .post(
          this.animeapi + "contents/thumbnail/" + this.$route.params.id,
          data,
          {
            headers: {
              "content-type": "multipart/form-data"
            }
          }
        )
        .then(response => {
          let reader = new FileReader();
          reader.onload = function(e) {
            $("#imgThumbnail").attr("src", e.target.result);
          };
          reader.readAsDataURL($("#fileThumbnail").prop("files")[0]);
          $("#loading").attr("hidden", "");
          $("#imgThumbnail").removeAttr("hidden");
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },
    deleteContent() {
      $("#btnDelete")
        .attr("disabled", "")
        .text("Processing...");
      axios
        .delete(this.animeapi + "contents/" + this.$route.params.id)
        .then(response => {
          $("#modalDelete").modal("toggle");
          this.$router.push("/admin/content");
        });
    }
  }
};
</script>
