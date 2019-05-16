<template>
  <div>
    <div class="row">
      <div class="col-md-3">
        <sidebar></sidebar>
      </div>
      <div class="col-md-9">
        <br>
        <div class="row">
          <div class="col-md-10">
            <h3>Studio List</h3>
          </div>
          <div class="col-md-2">
            <router-link
              class="btn btn-success"
              data-toggle="modal"
              data-target="#modalAdd"
              style="float:right"
              to="/admin/studio/add"
            >+ Add</router-link>
          </div>
        </div>
        <br>
        <table class="table" id="tableStudio">
          <thead>
            <tr>
              <th>Id</th>
              <th style="width: 80%">Name</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
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
  created() {
    this.loadDataTable();
  },
  methods: {
    loadDataTable() {
      let operdata = this.animeapi;
      let router = this.$router;
      $(document).ready(function() {
        let dataTable = $("#tableStudio").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: operdata + "studios/addon/datatable",
            type: "GET"
          },
          columns: [
            { data: "id" },
            { data: "name" },
            {
              render: function(data, type, full, meta) {
                return "<button class='btn btn-warning'>Detail</button>";
              }
            }
          ]
        });
        $("#tableStudio_paginate").attr("style", "float:right;");
        $("#tableStudio_filter").attr("style", "float:right;");
        $("#tableStudio").on("click", "button", function() {
          router.push("/admin/studio/detail/"+dataTable.row($(this).closest("tr")).data().id);
        });
      });
    }
  }
};
</script>
