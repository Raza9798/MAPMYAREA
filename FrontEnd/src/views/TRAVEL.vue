<template>
  <div id="TRAVEL">
    <v-row>
      <v-col
        ><v-list v-show="distanceInKM">
          <v-list-item-group color="primary">
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  {{ routeName[0] }}
                </v-list-item-title>
                <v-list-item-title>
                  <v-btn
                    color="primary"
                    v-show="distanceInKM"
                    dark
                    @click.stop="dialog = true"
                  >
                    Open Route Navigation Calculator
                  </v-btn></v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
        <div>
          <v-expansion-panels v-model="panel" :disabled="disabled" multiple>
            <v-expansion-panel>
              <v-expansion-panel-header
                >Registered Organizations</v-expansion-panel-header
              >
              <v-expansion-panel-content>
                <v-card class="mx-auto" tile>
                  <v-list>
                    <v-list-item-group color="primary">
                      <v-list-item
                        v-for="(item, index) in getData[0]"
                        :key="index"
                      >
                        <v-list-item-content>
                          <v-list-item-title
                            >{{ item.id }} - {{ item.Name }}</v-list-item-title
                          >
                          <v-list-item-subtitle class="ml-5 p-1">
                            {{ item.Desc }}
                          </v-list-item-subtitle>
                        </v-list-item-content>
                      </v-list-item>
                    </v-list-item-group>
                  </v-list>
                </v-card>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </div>
      </v-col>
      <v-col>
        <div id="map" class="map"></div>
      </v-col>
    </v-row>

    <!-- model  -->
    <div class="text-center">
      <v-dialog v-model="dialog" width="500">
        <v-card>
          <v-card-title class="headline grey lighten-2">
            Driver Route Navigation Calculator
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col>
                <v-col cols="12" sm="12">
                  <v-text-field
                    v-model="distanceInKM"
                    label="TOTAL DISTANCE IN KM"
                    outlined
                    disabled=""
                    shaped
                  ></v-text-field>
                </v-col>
              </v-col>
              <v-col>
                <v-col cols="12" sm="12">
                  <v-text-field
                    v-model="pricePerKM"
                    label="Fuel Waste / Km (Rs)"
                    outlined
                    @input="PriceChange(pricePerKM)"
                    shaped
                  ></v-text-field> </v-col
              ></v-col>
            </v-row>
            <v-row>
              <v-col>
                <v-col cols="12" sm="12">
                  <h2>
                    Expense Amount :
                    <span class="text-success"> Rs {{ expense }} </span>
                  </h2>
                </v-col>
              </v-col>
            </v-row>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="dialog = false">
              I accept
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </div>
</template>

<script>
const itemData = [];
export default {
  name: "TRAVEL",
  data() {
    return {
      tokenAPI:
        "pk.eyJ1IjoiZGV2c2NyaXB0MCIsImEiOiJja2RoZHBjbnQyejdxMnpzODI2eWZoMDNmIn0.s42lHaj3kW_w_mwQ_P6SIw",
      distance: 0,
      dialog: false,
      distanceInKM: 0,
      pricePerKM: 6,
      expense: 0,
      routeName: "",
      getData: [],
      panel: [],
      disabled: false,
      readonly: false,
    };
  },
  created() {},
  mounted() {
    this.getOrgnizationData();
  },
  methods: {
    getOrgnizationData() {
      this.$http.get("/Organization").then((response) => {
        this.getData.push(response.data.getData);
        localStorage.setItem("test", JSON.stringify(response.data.getData));
      });

      this.mapInit();
    },
    mapInit() {
      mapboxgl.accessToken = this.tokenAPI;
      let map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11",
        center: [79.81649992365908, 6.71975504815947],
        zoom: 7,
      });

      map.addControl(
        new MapboxGeocoder({
          accessToken: mapboxgl.accessToken,
          mapboxgl: mapboxgl,
        })
      );

      map.addControl(new mapboxgl.NavigationControl());

      map.addControl(
        new MapboxDirections({
          accessToken: mapboxgl.accessToken,
          mapboxgl: mapboxgl,
        }).on("route", (e) => {
          let routes = e.route;
          this.distance = routes.map((r) => r.distance);
          this.distanceInKM = this.distance / 1000;

          let amount = this.distanceInKM * this.pricePerKM;
          let amountInt = Math.floor(amount);
          this.expense = amountInt;

          let mapRoutes = routes.map((r) => r.legs[0].summary);
          this.routeName = mapRoutes;

          this.dialog = true;
        }),
        "top-left"
      );

      // GPS current
      map.addControl(
        new mapboxgl.GeolocateControl({
          positionOptions: {
            enableHighAccuracy: true,
          },
          trackUserLocation: true,
        })
      );

      const activities = JSON.parse(localStorage.getItem("test"));

      // placing marker
      activities.forEach(function(marker) {
        new mapboxgl.Marker().setLngLat([marker.Lng, marker.Lat]).addTo(map);

        var popup = new mapboxgl.Popup({ closeOnClick: false, offset: 28 })
          .setLngLat([marker.Lng, marker.Lat])
          .setHTML("<p>" + marker.Name + "</p>")
          .addTo(map);

        map.on("click", function(e) {
          new mapboxgl.Marker()
            .setLngLat([marker.Lng, marker.Lat])
            .setPopup(
              new mapboxgl.Popup({ offset: 25 }) //  popup marker offset
                .setHTML("<p class=''> ---  " + marker.Desc + " --- </p>")
            )
            .addTo(map);
        });
      });
    },

    PriceChange(price) {
      let amount = this.distanceInKM * this.pricePerKM;
      let amountInt = Math.floor(amount);
      this.expense = amountInt;
    },
  },
};
</script>
<style lang="css" scoped>
.map {
  width: 100%;
  height: 500px;
}
</style>
