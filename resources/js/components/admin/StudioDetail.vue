<template>
  <div>
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
              v-on:click="deleteStudio()"
              class="btn btn-danger"
            >Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <sidebar></sidebar>
      </div>
      <div class="col-md-9">
        <br>
        <h3>Detail</h3>
        <div class="row">
          <div class="col-md-6">
            <form @submit.prevent="updateStudio()">
              <div id="form-group">
                <label>Studio Name</label>
                <input type="textfield" class="form-control" id="txName" placeholder="Studio Name">
              </div>
              <br>
              <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
              <button
                type="button"
                id="btnDelete"
                data-toggle="modal"
                data-target="#modalDelete"
                class="btn btn-danger"
              >Delete</button>
            </form>
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
  created() {
    this.studioDetail();
  },
  methods: {
    studioDetail() {
      axios
        .get(this.animeapi + "studios/" + this.$route.params.id)
        .then(response => {
          $("#txName").val(response.data.result.name);
        });
    },
    updateStudio() {
      $("#btnSubmit")
        .attr("disabled", "")
        .text("Processing...");
      axios
        .put(this.animeapi + "studios/" + this.$route.params.id, {
          name: $("#txName").val()
        })
        .then(response => {
          this.$router.push("/admin/studio");
        });
    },
    deleteStudio(){
      $("#btnDelete").attr("disabled","").text("Processing...");
      axios.delete(this.animeapi+"studios/"+this.$route.params.id).then(response=>{
        $("#modalDelete").modal("toggle");
        this.$router.push("/admin/studio");
      })
    }
  }
};
</script>