<template>
    <div>
      <div class="row">
        <div class="col-lg-9">
          <vc-date-picker
          color="red"
          mode='multiple'
          v-model='dates'
          :attributes="attributes"
          :disabled-dates="orderdates[0]"
          />
       </div>
        <div class="col-lg-3 text-right">
          <button class="btn btn-danger " @click="savedate()">Make Unvailable</button>
        </div>

        <!-- <div class="col-lg-4">
          <vc-date-picker
          color="green"
          mode='multiple'
          v-model='availabledates'
          :attributes="attributes"
          :disabled-dates="dates"
          />
       </div>
        <div class="col-lg-2 text-right">
          <button class="btn btn-success " @click="makeavailabledate()">Make Available</button>
        </div> -->
      </div>
    <vc-calendar
      :attributes="attributes"
      :columns="$screens({ default: 1, lg: 2 })"
      :rows="$screens({ default: 1, lg: 2 })"
      :is-expanded="$screens({ default: true, lg: true })"
      :min-date="new Date()"
    />
   
    </div>
</template>

<script>
    export default {
        props: ['category_id'],
        data() {
          return {
            orderdates: [],
            attributes: [
              
            ],
            dates: "",
            availabledates: "",
          };
        },

        created: function () {
          // this.dates= this.dates.concat(this.orderdates[0])

          axios.get(`/getdates/${this.category_id}`)
          .then((response) => {

                  this.orderdates =  response.data.map(item => item.dates.split(",").map(elem => new Date(elem)))
                  let orderabledate = 
                      {
                        dot: 'purple',
                        dates: this.orderdates[0],
                        popover: {
                        label:
                          "Order days"
                        }
                      }; 
                  this.attributes.push(orderabledate)  
          });

          axios.get(`/getunavailabledates/${this.category_id}`)
            .then((response) => {
              if (response.data != "") {
                this.dates = response.data.map(elem => new Date(elem))
               }else{
                  this.dates = []
                } 

                // alert(this.orderdates[0] == undefined)
                let unvailable = 
                      {
                        dot: 'red',
                        dates: this.orderdates[0] == undefined ? this.dates : this.dates.concat(this.orderdates[0]),
                        popover: {
                        label:
                          "Unvailable days"
                        }
                      }; 
                this.attributes.push(unvailable) 
             
              
            });


            // this.$http.get(`/getavailabledates/${this.category_id}`)
            // .then((response) => {
            //   if (response.data != "") {
            //     this.availabledates = response.data.map(elem => new Date(elem))
            //    }else{
            //       this.availabledates = []
            //     } 
            //     let available = 
            //           {
            //             dot: 'green',
            //             dates: this.availabledates,
            //             popover: {
            //             label:
            //               "Available days"
            //             }
            //           }; 
            //     this.attributes.push(available) 
             
              
            // });

        },
        mounted() {
          
        },
        methods: {
          
            savedate: function () {
              if (this.dates == "") {this.dates = "null"}
              const uri = `/savedates/${this.category_id}/${this.dates}`;
              axios.get(uri).then((response) => {
                console.log(response.data)
              });
              window.location.reload(true);
            },

            makeavailabledate: function(){
                if (this.dates == "") {this.dates = "null"}
                const uri = `/saveavailabledates/${this.category_id}/${this.availabledates}`;
                axios.get(uri).then((response) => {
                  console.log(response.data)
                });
                window.location.reload(true);
            }
          }
      }
</script>
