<template>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Reports Table</h3>
        <div class="card-tools">
          <button class="btn btn-primary" @click="newModal">Add Report</button>
        </div>
      </div>
      <div class="card-body">
        <div class="col-xs-12 col-md-6 col-lg-6">
            <select name="division" v-model="division" @change="loadReports" id="division" class="form-control">
                <option value="" default>All</option>
                <option>Official</option>
                <option>Mechanic</option>
                <option>Electronic</option>
                <option>Programming</option>
            </select>
        </div>


        <table id="tabel-user" class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Date</th>
              <th>Author</th>
              <th>Division</th>
              <th>Report</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="report in reports.data" :key="report.id_laporan">
              <td>{{report.waktu | myDate}}</td>
              <td>{{report.nama}}</td>
              <td>{{report.role}}</td>
              <td>
                <a style="cursor:pointer" @click="showModal(report)">
                  <i class="fas fa-external-link-alt"></i>
                </a>
              </td>
              <td>
                <a href="#" @click="editModal(report)">
                  <i class="fa fa-edit text-blue"></i>
                </a>
                /
                <a href="#" @click="deleteReport(report.id_laporan)">
                  <i class="fa fa-trash text-red"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="card-footer">
        <pagination :data="reports" @pagination-change-page="getResults"></pagination>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="addReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" v-show="!editmode" id="addReportLabel">Add report</h5>
          <h5 class="modal-title" v-show="editmode" id="addReportLabel">Edit report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form @submit.prevent="editmode ? editReport():createReport()">
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input v-model="form.nama" type="text" name="nama" placeholder="Jhonny Yes Phapa" class="form-control" :class="{ 'is-invalid': form.errors.has('nama') }">
              <has-error :form="form" field="nama"></has-error>
            </div>

            <div class="form-group">
              <label>Division</label>
              <select name="role" v-model="form.role" id="role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                  <option value="" disabled default>Select Division</option>
                  <option value="official">Official</option>
                  <option value="mechanic">Mechanic</option>
                  <option value="electronic">Electronic</option>
                  <option value="programming">Programming</option>
              </select>
              <has-error :form="form" field="role"></has-error>
            </div>

            <div class="form-group">
              <label>Date</label>
              <input v-model="form.waktu" type="date" name="waktu" class="form-control" :class="{ 'is-invalid': form.errors.has('waktu') }">
              <has-error :form="form" field="waktu"></has-error>
            </div>
            <div class="form-group">
              <label>Report Title</label>
              <input v-model="form.title_laporan" type="text" name="title_laporan" placeholder="Umaru Rekorr" class="form-control" :class="{ 'is-invalid': form.errors.has('title_laporan') }">
              <has-error :form="form" field="title_laporan"></has-error>
            </div>
            <div class="form-group">
              <label>Report Content</label>
              <textarea rows="5" v-model="form.body_laporan" type="text" name="body_laporan" placeholder="Latihan full time 8 gol" class="form-control" :class="{ 'is-invalid': form.errors.has('body_laporan') }"></textarea>
              <has-error :form="form" field="body_laporan"></has-error>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button v-show="editmode" type="submit" class="btn btn-primary">Update</button>
            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showLabel">{{form.waktu|myDate}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <strong>{{form.title_laporan}}</strong>
            <br>
            <br>
            <p style="white-space: pre-line;">{{ form.body_laporan }}</p>
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
      division:'',
      divisionAPI:'',
      editmode: false,
      reports: {},
      form: new Form({
        id_laporan:'',
        nama: '',
        title_laporan: '',
        body_laporan: '',
        waktu: '',
        role: '',
      })
    }
  },
  methods: {
    showModal(report){
        this.form.clear();
        this.form.reset();
        $('#show').modal('show');
        this.form.fill(report);
    },
    editReport(){
        this.$Progress.start()
        this.form.put('api/report/' + this.form.id_laporan)
        .then(() => {
            //success
          Fire.$emit('AfterChange');
          $('#addReport').modal('hide')

          Toast.fire({
            icon: 'success',
            title: 'Report updated successfully'
          })
          this.$Progress.finish()
        })
        .catch(() => {
            this.$Progress.fail()
        });
    },
    editModal(report){
        console.log(report);
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addReport').modal('show');
        this.form.fill(report);
    },
    newModal(){
        this.editmode = false;
        this.form.clear();
        this.form.reset();
        $('#addReport').modal('show');
    },
    deleteReport(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {

        //send req to server
        if (result.isConfirmed) {
          this.form.delete('api/report/' + id).then(() => {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your report data has been deleted.',
              'success'
            )
            Fire.$emit('AfterChange');

          }).catch(() => {
            Swal("Failed!", "There was something wrong.", "warning");
          })
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your report data is safe :)',
            'error'
          )
        }
      })
    },
    getResults(page = 1)
    {
        if(this.division == "Official") this.divisionAPI = "api/official_report"
        else if(this.division == "Mechanic") this.divisionAPI = "api/mechanic_report"
        else if(this.division == "Electronic") this.divisionAPI = "api/electronic_report"
        else if(this.division == "Programming") this.divisionAPI = "api/programming_report"
        else this.divisionAPI = "api/report"

      axios.get(this.divisionAPI+'?page=' + page)
        .then(response => {
          this.reports = response.data;
        });
    },
    loadReports()
    {
        if(this.division == "Official") this.divisionAPI = "api/official_report"
        else if(this.division == "Mechanic") this.divisionAPI = "api/mechanic_report"
        else if(this.division == "Electronic") this.divisionAPI = "api/electronic_report"
        else if(this.division == "Programming") this.divisionAPI = "api/programming_report"
        else this.divisionAPI = "api/report"
      axios.get(this.divisionAPI).then(({
        data
      }) => (this.reports = data));
    },
    createReport() {
      this.$Progress.start()
      this.form.post('api/report')
        .then(() => {
          Fire.$emit('AfterChange');
          $('#addReport').modal('hide')

          Toast.fire({
            icon: 'success',
            title: 'Report added successfully'
          })
          this.$Progress.finish()

        })
        .catch(() => {
            this.$Progress.fail()
        })
    }
  },
  created() {
    this.loadReports();
    Fire.$on('AfterChange', () => {
      this.loadReports()
    })
    // setInterval(() => this.loadReports(), 3000);
  },
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
