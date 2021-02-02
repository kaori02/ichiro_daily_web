<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form @submit.prevent>
          <div class="form-group">
            <label for="event_name">Event Name</label>
            <input type="text" v-model="form.title" id="event_name" name="title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
            <has-error :form="form" field="title"></has-error>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start">Start Date</label>
                <input
                  v-model="form.start"
                  type="date"
                  id="start"
                  name="start"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('start') }">
                <has-error :form="form" field="start"></has-error>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="end">End Date</label>
                <input type="date" v-model="form.end" id="end" name="end" class="form-control" :class="{ 'is-invalid': form.errors.has('end') }">
                <has-error :form="form" field="end"></has-error>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="time_start">Time Start</label>
                <input type="time" v-model="form.time_start" id="time_start" name="time_start" class="form-control" :class="{ 'is-invalid': form.errors.has('time_start') }">
                <has-error :form="form" field="time_start"></has-error>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="time_end">Time End</label>
                <input type="time" v-model="form.time_end" id="time_end" name="time_end" class="form-control" :class="{ 'is-invalid': form.errors.has('time_end') }">
                <has-error :form="form" field="time_end"></has-error>
              </div>
            </div>
            <div class="col-md-6 mb-4" v-if="addingMode">
              <button type="submit" class="btn btn-sm btn-primary" @click="addNewEvent">Save Event</button>
            </div>
            <template v-else>
              <div class="col-md-6 mb-4">
                <button class="btn btn-sm btn-success" @click="updateEvent">Update</button>
                <button class="btn btn-sm btn-danger" @click="deleteEvent">Delete</button>
                <button class="btn btn-sm btn-secondary" @click="cancelEvent">Cancel</button>
              </div>
            </template>
          </div>
        </form>
      </div>
      
      <div class="col-md-8">
        <Fullcalendar :options="calendarOptions"/>
      </div>
    </div>
  </div>
  
</template>



<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
  components: {
    'Fullcalendar': FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      addingMode: true,
      indexToUpdate: "",
      indexDragAndDrop: "",
      event: {},
      form: new Form ({
        title: '',
        start: '',
        end: '',
        time_start: '',
        time_end: '',
      }),
      calendarOptions: {
        plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin, listPlugin],
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
        },
        initialView: "dayGridMonth",
        dateClick: this.handleDateClick,
        events: 'api/calendar',
        eventClick: this.showEvent,
        editable: true,
        eventDrop: this.dragAndResizeEvent, 
        eventResize: this.dragAndResizeEvent,
        eventTimeFormat: {
          hour: '2-digit',
          minute: '2-digit',
          hour12: false,
        }
      },
    }
  },

  
  
  methods: {
    loadEvents() {
      axios.get("/api/calendar").then(response => (this.event  = response.data));  
    },
    addNewEvent() {
      this.$Progress.start();
      if(this.form.time_start != '' && this.form.time_end != ''){ 
        this.form.start = this.form.start + "T" + this.form.time_start;
        this.form.end = this.form.end + "T" + this.form.time_end;
        this.form.allDay = false;
      }
      this.form.post("/api/calendar")
      .then(() => {

        Toast.fire({
          icon: 'success',
          title: 'Event added successfully'
        })

        this.$Progress.finish();
        this.loadEvents();
        // kalau bisa ada delay-nya
        window.location.reload(1); //untuk reload webnya
      })
      .catch(() => {
        this.$Progress.fail();
      })
    },
    showEvent(arg) {
      console.log(arg.event)
      this.addingMode = false;
      this.form.reset();
      this.indexToUpdate = arg.event.id;
      this.form.title = arg.event.title;
      this.form.start = this.convert(arg.event.start);
      this.form.end = this.convert(arg.event.end);

      if(arg.event.allDay == false){
        this.form.time_start = this.takeTime(arg.event.start);
        this.form.time_end = this.takeTime(arg.event.end);
      }
    },
    dragAndResizeEvent(arg){
      // console.log(arg.event.title);
      this.indexToUpdate = arg.event.id;
      this.form.title = arg.event.title;
      this.form.start = this.convert(arg.event.start);
      this.form.end = this.convert(arg.event.end);
      console.log(this.form.start);
      console.log(this.form.end);

      if(arg.event.allDay == false){  
        this.form.time_start = this.takeTime(arg.event.start);
        this.form.time_end = this.takeTime(arg.event.end);
        this.form.start = this.form.start + "T" + this.form.time_start;
        this.form.end = this.form.end + "T" + this.form.time_end;
      } 
      // supaya end date nya tidak jadi 1970-01-01
      // else if(arg.event.allDay == true){
      //   console.log(this.form.end);
      //   this.form.end = this.convertAllDay(arg.event.start);
      // }
      this.form.put("api/calendar/" + this.indexToUpdate); 
      this.form.reset(); 
      // window.location.reload(1);
    },
    updateEvent(){
      console.log('update');
      if(this.form.time_start != '' && this.form.time_end != ''){
        console.log('masuk');
        this.form.start = this.form.start + "T" + this.form.time_start;
        this.form.end = this.form.end + "T" + this.form.time_end;
      }
      this.form.put("api/calendar/" + this.indexToUpdate);
      // this.form.reset();
      window.location.reload(1);
    },
    deleteEvent(){
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
          this.form.delete('api/calendar/' + this.indexToUpdate).then(() => {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your event has been deleted.',
              'success'
            ).then((result1) => {
                if(result1.isConfirmed) {
                  this.form.reset();
                  window.location.reload(1);
                }
            })
          }).catch(() => {
            Swal("Failed!", "There was something wrong.", "warning");
          })
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your event is safe :)',
            'error'
          )
        }
      })
    },
    cancelEvent(){
      this.addingMode = !this.addingMode;
      this.form.clear();
      this.form.reset();
    },
    convert(str) {
      var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
      return [date.getFullYear(), mnth, day].join("-");
    },
    convertAllDay(str) {
      var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        tempDay = date.getDate() + 1,
        day = ("0" + tempDay);
      return [date.getFullYear(), mnth, day].join("-");
    },
    takeTime(str) {
      var date = new Date(str),
        hours = date.getHours(),
        minute = date.getMinutes();
        if(minute<10) {
          minute = "0"+ minute  
        }
        if(hours<10) {
          hours = "0"+ hours
        }
      return [hours, minute].join(":");
    }
  },
  created() {
    this.loadEvents();
    // Fire.$on('AfterChange', () => {
    //   this.loadEvents()
    // })
    // axios.get("api/calendar").then(response => console.log(response));
  },

  

  
  
  
}
</script>
