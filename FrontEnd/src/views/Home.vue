<template>
  <div class="home">
    <v-row>
      <v-col class="m-0   colImage">
        <v-row>
          <v-col class="  m-5 boxContainer">
            <v-card color="basil">
              <v-tabs
                v-model="tab"
                background-color="transparent"
                color="basil"
                height="100px"
              >
                <v-tab class="tabBox">
                  <v-icon>mdi-account-reactivate</v-icon>
                  <br />
                  <p>REGISTER</p>
                </v-tab>
                <v-tab class="tabBox">
                  <v-icon>mdi-car-arrow-right</v-icon>
                  <br />
                  <p>RIDE</p>
                </v-tab>
              </v-tabs>

              <v-tabs-items v-model="tab">
                <v-tab-item>
                  <v-card color="basil" height="300px" class="  w-50" flat>
                    <v-card-text>
                      <v-row>
                        <v-col class=" tab01">
                          <h1>Register Your Business</h1>
                          <h3>With us</h3>
                          <p>
                            Take full advantage of the best channel for customer
                            engagement without the challenge of building an
                            in-house digital advertising team. MAP MY-AREA works
                            with advertisers to help them share their message
                            and engage their customers on digital and social
                            platforms.
                          </p>
                          <v-btn
                            class="ma-2 NBTN"
                            to="/creg"
                            tile
                            color="dark"
                            dark
                            >CLIENT REGISTER
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-tab-item>
                <v-tab-item>
                  <v-card color="basil" height="300px" flat>
                    <v-card-text
                      ><v-row>
                        <v-col class=" tab01">
                          <h1>
                            The Technology That Enables FASTER, SAFER, SMARTER
                            Traveling.
                          </h1>
                        </v-col>
                        <v-col class=" tab02">
                          <!-- Display MAP -->
                          <v-btn
                            class="ma-2 NBTN"
                            to="/travel"
                            tile
                            color="dark"
                            dark
                            >TRAVEL
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-tab-item>
              </v-tabs-items>
              <div id="map" class="map"></div>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>

    <v-row> <v-col class="mt-t mb-1 deliveyImage"> </v-col> </v-row>
    <v-row>
      <v-col class="mt-5 ml-5"
        ><h3>MAP MY-AREA for Business</h3>
        <p>The power of MAP MY-AREA in everyday business</p>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="m-1">
        <v-card class="mx-auto" max-width="400">
          <v-img
            class="white--text align-end"
            height="200px"
            src="../assets/business-eater-horz2x.png"
          >
          </v-img>

          <v-card-subtitle class="pb-0"><h4>Work meals</h4></v-card-subtitle>

          <v-card-text class="text--primary">
            <div>
              Delight your employees with their favorite meals delivered
              directly to anywhere they work.
            </div>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col class="m-1">
        <v-card class="mx-auto" max-width="400">
          <v-img
            class="white--text align-end"
            height="200px"
            src="../assets/employee-travel-horz2x.png"
          >
          </v-img>

          <v-card-subtitle class="pb-0"
            ><h4>Employee rides</h4></v-card-subtitle
          >

          <v-card-text class="text--primary">
            <div>
              Take the work out of work-related trips. Create ground travel and
              commute programs for employees
            </div>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col class="m-1">
        <v-card class="mx-auto" max-width="400">
          <v-img
            class="white--text align-end"
            height="200px"
            src="../assets/ride-coordinator-horz2x.png"
          >
          </v-img>

          <v-card-subtitle class="pb-0"
            ><h4>Courtesy rides</h4></v-card-subtitle
          >

          <v-card-text class="text--primary">
            <div>
              Aim to impress. Arrange door-to-door rides for your customers,
              clients, and guests
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col class="m-5">
        <h1>Our commitment to your safety</h1>
        <p>
          With every safety feature we add and every standard in our Community
          Guidelines we uphold, we're committed to working to create a safe
          environment for our users.
        </p>
      </v-col>
      <v-col class="m-5">
        <v-img src="../assets/Safety_ilo.svg"></v-img>
      </v-col>
    </v-row>

    <v-row>
      <v-col class="m-1">
        <v-card class="mx-auto" flat outlined raised shaped max-width="400">
          <v-card-subtitle class="pb-0 b"><h4>About us</h4></v-card-subtitle>

          <v-card-text class="text--primary">
            <div>
              Find out how we started, what drives us, and how we’re igniting
              opportunity.
            </div>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col class="m-1">
        <v-card class="mx-auto" flat outlined raised shaped max-width="400">
          <v-card-subtitle class="pb-0"><h4>Newsroom</h4></v-card-subtitle>

          <v-card-text class="text--primary">
            <div>
              See announcements about our latest releases, initiatives, and
              partnerships.
            </div>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col class="m-1">
        <v-card class="mx-auto" flat outlined raised shaped max-width="400">
          <v-card-subtitle class="pb-0"
            ><h4>Global citizenship</h4></v-card-subtitle
          >

          <v-card-text class="text--primary">
            <div>
              Read about our commitment to making a positive impact in the
              cities we serve.
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <Footer />
  </div>
</template>

<script>
import Footer from "../components/Footer";
export default {
  name: "Home",
  components: {
    Footer,
  },
  data() {
    return {
      tab: null,
      items: ["Register", "Ride"],
      text:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    };
  },
  mounted() {
    mapboxgl.accessToken =
      "pk.eyJ1IjoiZGV2c2NyaXB0MCIsImEiOiJja2RoZHBjbnQyejdxMnpzODI2eWZoMDNmIn0.s42lHaj3kW_w_mwQ_P6SIw";
    let map = new mapboxgl.Map({
      container: "map",
      style: "mapbox://styles/mapbox/streets-v11",
      center: [80.06275, 7.00729],
      zoom: 8,
    });

    map.addControl(
      new mapboxgl.GeolocateControl({
        positionOptions: {
          enableHighAccuracy: true,
        },
        trackUserLocation: true,
      })
    );
  },
};
</script>
<style lang="css" scoped>
.colImage {
  background-image: url("../assets/T_Bikes_16_9.jpg");
  background-color: #fff;
  height: 800px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.boxContainer {
  opacity: 0.9;
}
.tabBox {
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.tab01 {
  height: 100px;
}
.tab02 {
  height: 500px;
}
.NBTN {
  text-decoration: none;
}

.map {
  width: 100%;
  height: 300px;
}
.deliveyImage {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5)),
    url("../assets/AAEAAQAAAAAAAAQ1AAAAJDAxM2M2ZGM0LTllNTYtNDVmMi04YzNmLTVmMjNmMzJmNzFkYQ.png");
  background-color: #fff;
  height: 300px;
  background-position: 10%;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
