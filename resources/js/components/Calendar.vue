<template>
<div class="container">
  <FullCalendar :options="calendarOptions" />
</div>
</template>

<script>
export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        dateClick: this.handleDateClick,
        events: [{
            title: 'event 1',
            date: '2020-11-01'
          },
          {
            title: 'event 2',
            date: '2020-11-02'
          }
        ]
      }
    }
  },
  methods: {
    handleDateClick: function (arg) {
      alert('date click! ' + arg.dateStr)
    }
  },
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
