<template>
  <div class="CREG">
    <v-row>
      <v-col>
        <div class="text-center">
          <v-snackbar
            v-model="snackbar"
            :timeout="timeout"
            multi-line
            right
            top
            rounded
            transition="fab-transition"
            color="success"
          >
            Location Registered Successfully
          </v-snackbar>
        </div>
        <v-row
          ><v-col class="bg-dark text-light p-3 text-center">
            REGISTER YOUR ORGANIZATION
          </v-col></v-row
        >
        <v-row v-if="errorMessage != ''"
          ><v-col class="bg-danger text-light p-3 text-center">
            {{ errorMessage }}
          </v-col></v-row
        >

        <v-row>
          <v-col>
            <v-col cols="12" sm="12">
              <v-text-field
                label="ORGANIZATION NAME"
                outlined
                v-model="Form.Name"
                :rules="ErrorRules.Name"
                clearable
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12">
              <v-text-field
                label="PHONE NUMBER"
                type="Number"
                outlined
                v-model="Form.Phone"
                :rules="ErrorRules.Phone"
                clearable
              ></v-text-field>
            </v-col>
            <v-row class="m-auto">
              <v-col cols="12" sm="6">
                <v-text-field
                  label="Location Latitude"
                  outlined
                  disabled=""
                  placeholder="SELECT LOCATION ON THE MAP"
                  v-model="foundCoordinatesLat"
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="1">
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      @click="restoreMap"
                      icon
                      v-bind="attrs"
                      v-on="on"
                      class=" mt-2  "
                    >
                      <v-icon color="grey lighten-1"
                        >mdi-trash-can-outline</v-icon
                      >
                    </v-btn>
                  </template>
                  <span>Clear / Refresh the map</span>
                </v-tooltip>
              </v-col>
              <v-col cols="12" sm="5">
                <v-text-field
                  label="Location Longitude"
                  outlined
                  disabled=""
                  placeholder="SELECT LOCATION ON THE MAP"
                  v-model="foundCoordinatesLng"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-col cols="12" sm="12">
              <v-textarea
                label="SHORT INFO FOR YOUR ORGANIZATION"
                auto-grow
                outlined
                v-model="Form.Desc"
                clearable
                rows="2"
                row-height="35"
                counter="80 "
                :rules="ErrorRules.About"
              ></v-textarea>
              <v-btn
                class="ma-2 NBTN"
                @click="Register"
                tile
                color="indigo"
                dark
                >REGISTER
              </v-btn>
            </v-col>
          </v-col>
        </v-row>
      </v-col>
      <v-col>
        <div id="map" class="map"></div>
        <pre id="info"></pre>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: "CREG",
  data() {
    return {
      ErrorRules: {
        Name: [
          (v) => !!v || "Name is required",
          (v) => v.length <= 100 || "Name must be less than 100 characters",
        ],
        About: [
          (v) => !!v || "Description is required",
          (v) =>
            v.length <= 80 || "Description must be less than 80 characters",
        ],
        Phone: [
          (v) => !!v || "Phone number is required",
          (v) =>
            (v.length <= 10 && v.length >= 10) ||
            "Phone number must be  10 characters",
        ],
      },
      Form: {
        Name: null,
        Phone: null,
        Desc: null,
      },
      foundCoordinatesLat: 0,
      foundCoordinatesLng: 0,
      errorMessage: "",
      successMessage: "",
      snackbar: false,
      timeout: 2000,
      tokenAPI:
        "pk.eyJ1IjoiZGV2c2NyaXB0MCIsImEiOiJja2RoZHBjbnQyejdxMnpzODI2eWZoMDNmIn0.s42lHaj3kW_w_mwQ_P6SIw",
    };
  },
  mounted() {
    this.init();
  },

  methods: {
    init() {
      mapboxgl.accessToken = this.tokenAPI;
      let map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11",
        center: [82.86760930258288, 6.61269103337257],
        zoom: 5,
      });

      map.addControl(
        new MapboxGeocoder({
          accessToken: mapboxgl.accessToken,
          mapboxgl: mapboxgl,
        })
      );

      //current location
      map.addControl(
        new mapboxgl.GeolocateControl({
          positionOptions: {
            enableHighAccuracy: true,
          },
          trackUserLocation: true,
        })
      );

      // FIND LAT LNG by mouse move
      map.on("mousemove", function(e) {
        document.getElementById("info").innerHTML =
          JSON.stringify(e.point) + "<br />" + JSON.stringify(e.lngLat.wrap());

        let coo = e.lngLat.wrap();

        localStorage.setItem("choosed_coordinates", JSON.stringify(coo));

        console.log(coo["lng"]);
        console.log(coo["lat"]);
      });

      // onclick Map
      map.on(
        "click",
        function(e) {
          let coo = JSON.parse(localStorage.getItem("choosed_coordinates"));

          this.foundCoordinatesLat = coo.lat;
          this.foundCoordinatesLng = coo.lng;

          let marker = new mapboxgl.Marker({
            //   draggable: true,
          })
            .setLngLat([this.foundCoordinatesLng, this.foundCoordinatesLat])
            .addTo(map);
        }.bind(this)
      );
    },
    restoreMap() {
      this.init();
      this.foundCoordinatesLat = 0;
      this.foundCoordinatesLng = 0;
      console.log("run code");
    },

    Register() {
      let store = [
        {
          Name: this.Form.Name,
          Phone: this.Form.Phone,
          Lat: this.foundCoordinatesLat,
          Lng: this.foundCoordinatesLng,
          Desc: this.Form.Desc,
        },
      ];

      if (
        store[0].Name &&
        store[0].Phone.length === 10 &&
        store[0].Lat &&
        store[0].Lng &&
        store[0].Desc
      ) {
        this.errorMessage = "";

        let uri = "/Organization";
        this.$http.post(uri, store[0]).then((response) => {
          this.successMessage = response.data.success;
          localStorage.setItem("test", JSON.stringify(response.data.storeData));
          console.log(response.data);
        });
        (this.Form = {
          Name: null,
          Phone: null,
          Desc: null,
        }),
          (this.foundCoordinatesLat = 0);
        this.foundCoordinatesLng = 0;
        this.snackbar = true;
        this.init();
      } else {
        this.errorMessage =
          "All the form fileds are reequired choose the location on Map";
      }

      console.log(store);
    },
  },
};
</script>
<style lang="css" scoped>
.map {
  width: 100%;
  height: 550px;
}
#info {
  display: none;
  position: relative;
  margin: 0px auto;
  width: 50%;
  padding: 10px;
  border: none;
  border-radius: 3px;
  font-size: 12px;
  text-align: center;
  color: #222;
  background: #fff;
}
.NBTN {
  text-decoration: none;
}
</style>
