<template>
<div class="container">
  <div class="card-header">
    <h3 class="card-title">Tabel Laporan</h3>
    <div class="card-tools">
      <button class="btn btn-primary" data-toggle="modal" data-target="#addReport">Add Report</button>
    </div>
  </div>
  <div class="table-responsive">
    <table id="tabel-user" class="table table-hover" style="width:100%">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th class="text-center">Nama</th>
          <th class="text-center">Waktu</th>
          <th class="text-center">Laporan</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">1</td>
          <td class="text-left">Dafa</td>
          <td class="text-center">5-11-2020</td>
          <td class="text-center">
            <a data-toggle="modal" data-target="#show" style="cursor:pointer"><i class="fas fa-external-link-alt"></i></a>
          </td>
          <td class="text-center">
            <a href="#">
              <i class="fa fa-edit text-blue"></i>
            </a>
            /
            <a href="#">
              <i class="fa fa-trash text-red"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addReportLabel">Add report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input v-model="form.nama" type="text" name="nama" class="form-control" :class="{ 'is-invalid': form.errors.has('nama') }">
            <has-error :form="form" field="nama"></has-error>
          </div>
          <div class="form-group">
            <label>Waktu</label>
            <input v-model="form.waktu" type="date" name="waktu" class="form-control" :class="{ 'is-invalid': form.errors.has('waktu') }">
            <has-error :form="form" field="waktu"></has-error>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showLabel">Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        nama: '',
        title_laporan: '',
        body_laporan: '',
        waktu: '',
      })
    }
  },
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
