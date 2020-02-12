<template>
    <div>
        <div class="success" v-if="submited==true">
            <p>Reservation is submited. Information is send to your email. Also you can download generated PDF </p>
            <button @click='btnClick' class="pdf">Download PDF</button>
        </div>
        <div class="danger" v-if="errorMessage!=''">
            <p>{{errorMessage}}</p>
        </div>
        <div class="signupSection">

            <form @submit.prevent="addReservation" class="signupForm" name="signupForm">
                <h2>Fill the fields</h2>
                <ul class="noBullet">
                    <li>
                        <label class="label" for="name">Name</label>
                        <input type="text" class="inputFields"
                               placeholder="Enter your name" v-model="reservation.name" value="" required/>
                        <span v-if="errors.name" class="error">{{errors.name[0]}}</span>
                    </li>
                    <li>
                        <label class="label" for="surname">Surname</label>
                        <input type="text" class="inputFields" id="surname" name="surname"
                               placeholder="Enter your surname" v-model="reservation.surname"/>
                        <span v-if="errors.surname" class="error">{{errors.surname[0]}}</span>
                    </li>
                    <li>
                        <label class="label" for="email">Email</label>
                        <input type="email" class="inputFields" id="email" name="email" placeholder="Enter your email"
                               v-model="reservation.email" required/>
                        <span v-if="errors.email" class="error">{{errors.email[0]}}</span>
                    </li>
                    <li>
                        <label class="label" for="start_date">Pick a date</label>
                        <input type="datetime-local" class="inputFields" id="start_date" name="start_date"
                               placeholder="Date" v-model="reservation.start_date" required/>
                        <span v-if="errors.start_date" class="error">{{errors.start_date[0]}}</span>
                    </li>
                    <li>
                    <li>
                        <label class="label" for="time"> How many hours?</label>
                        <input type="number" class="inputFields" min="1" max="4" id="time" name="time"
                               placeholder="Time" v-model="reservation.time" required/>
                        <span v-if="errors.time" class="error">{{errors.time[0]}}</span>
                    </li>
                    <li>
                        <label class="label" for="place_id"> Choose the place</label>
                        <select id="place_id" name="place_id" v-model="reservation.place_id" class="inputFields">
                            <option disabled value="">Please select one</option>
                            <option v-for="t in places" :key="t.id"
                                    v-bind:value="t.id">{{t.name}} ( {{t.address}} )
                            </option>
                        </select>
                        <span v-if="errors.place_id" class="error">{{errors.place_id[0]}}</span>
                    </li>
                    <li id="center-btn">
                        <input type="submit" id="join-btn" name="join" alt="Join" value="Submit reservation">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                reservation: {name: '', surname: '', email: '', start_date: '', place_id: '', time: ''},
                errors: [],
                res_id: '',
                errorMessage: '',
                submited: false,
                places: {id: '', name: '', address: ''}
            }
        },
        mounted() {
            this.loadData();
        },
        methods: {
            addReservation: function (e) {

                e.preventDefault();
                let reservation = this.reservation;

                let uri = 'api/create';
                axios.post(uri, reservation).then((response) => {
                    this.reservation = {
                        name: '',
                        surname: '',
                        email: '',
                        start_date: '',
                        time: '',
                        place_id: ''
                    };
                    this.errors = [];
                    this.errorMessage = '';
                    this.submited = true;
                    this.res_id = response.data.data.id;
                }).catch(error => {
                    this.errorMessage = "";
                    if (error.response.data.reservationRefused) {
                        this.errorMessage = error.response.data.reservationRefused;
                    }

                    this.res_id = '';
                    this.submited = false;
                    if (error.response) {
                        this.errors = error.response.data;
                        console.log(this.errors);
                    }
                })
            },
            btnClick: function () {
                location.href = "api/pdf/" + this.res_id;
            },
            loadData: function () {
                axios.get('api/places').then(res => {
                    if (res.status == 200) {
                        this.places = res.data;
                    }
                }).catch(err => {
                    console.log(err)
                });
            }
        }
    }
</script>

<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300);

    * {
        font-family: "Open Sans", sans-serif;
    }

    body {
        margin: 0;
        padding: 0;

        background: #111;
        background-repeat: no-repeat;
    }

    .signupSection {

        background-repeat: no-repeat;
        margin: auto;
        max-width: 800px;

        text-align: center;
        display: flex;
        color: white;
        box-shadow: 3px 10px 20px 5px rgba(0, 0, 0, 0.5);
    }

    .info {
        width: 45%;
        background: rgba(20, 20, 20, 0.8);
        padding: 30px 0;
        border-right: 5px solid rgba(30, 30, 30, 0.8);
    }

    .info h2 {
        padding-top: 30px;
        font-weight: 300;
    }

    .info p {
        font-size: 18px;
    }

    .info .icon {
        font-size: 8em;
        padding: 20px 0;
        color: #0ab4b4;
    }

    .pdf {
        border: 1px solid #0ab4b4;
        background-color: aliceblue;
        color: green;
        font-size: 14px;
        padding: 10px 50px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.4s;
    }

    .pdf:hover {

        padding: 10px 80px;
    }

    .signupForm {
        width: 100%;
        padding: 30px 0;
        background: rgba(20, 40, 40, 0.8);
        transition: 0.2s;
    }

    .signupForm h2 {
        font-weight: 300;
    }

    .label {

        display: block;
    }

    .inputFields {
        margin: 15px 0;
        font-size: 16px;
        padding: 10px;
        width: 250px;
        border: 1px solid #0ab4b4;
        border-top: none;
        border-left: none;
        border-right: none;
        background: rgba(20, 20, 20, 0.2);
        color: white;
        outline: none;
    }

    .noBullet {
        list-style-type: none;
        padding: 0;
    }

    #join-btn {
        border: 1px solid #0ab4b4;
        background: rgba(20, 20, 20, 0.6);
        font-size: 18px;
        color: white;
        margin-top: 20px;
        padding: 10px 50px;
        cursor: pointer;
        transition: 0.4s;
    }

    #join-btn:hover {
        background: rgba(20, 20, 20, 0.8);
        padding: 10px 80px;
    }

    .success {
        max-width: 800px;
        padding: 0.5em;
        text-align: center;
        margin: auto;
        display: block;
        background: green;
    }

    .danger {
        max-width: 800px;
        padding: 0.5em;
        text-align: center;
        margin: auto;
        display: block;
        background: red;
    }

    .error {
        display: block;
        color: red;
        padding-bottom: 2em;
    }
</style>

