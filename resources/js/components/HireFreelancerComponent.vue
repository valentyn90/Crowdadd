<template>
  <div class="wt-ratingcontent">
    <p>
      <em>*</em>
      {{ service_note }}
    </p>

    <b-button v-b-modal.modal-1 class="wt-btn">{{ buy_now }}</b-button>

    <b-modal id="modal-1" :title="hire_service_title" @ok="handleOk">
      <p class="text-center my-2">Please select  date.</p>
      <div class="text-center">
        <vc-date-picker
          mode="multiple"
          v-model="dates"
          :min-date="next_available_date"
          :disabled-dates="unavailabledays"
          color="purple"
          is-inline
          is-expanded
          :columns="$screens({ default: 1, lg: 2 })"
          :rows="$screens({ default: 1, lg: 2 })"
        />
      </div>
    </b-modal>

  </div>
</template>

<script>
import { format, compareAsc } from "date-fns";

export default {
  props: {
    next_available_date: String,
    service: Object,
    service_note: String,
    hire_service_title: String,
    hire_service_text: String,
    buy_now: String
  },
  data() {
    return {
      dates: [],
      unavailabledays:[]

    };
  },
  created: function (){
      axios.get(`/getfreedates/${this.service.seller[0].pivot.service_id}`)
            .then((response) => {

              var a = response.data[0].split(",")
              var b = response.data[1].split(",")
              // var m = response.data[1].split(",")

              // var result = a.concat(b).filter(function(el, i, c) {
              //     return el != c[i < a.length ? i + a.length : i - a.length];
              // });

              // console.log(result)

              var result = a.concat(b);
              alert(result)
              this.unavailabledays = result.map(elem => new Date(elem))
              })
  },
  mounted(){

  },
  methods: {
    handleOk() {
       let dates = this.dates.map(elem => format(elem, "yyyy-MM-dd"));
      window.location.replace(
        APP_URL + "/service/payment-process/" + this.service.id + "?dates=" + dates
      );
    }
  }
};
</script>
 