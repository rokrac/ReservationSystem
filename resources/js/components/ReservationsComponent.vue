<template>
    <div class="signupSection">
        <form class="signupForm" name="signupForm">
            <h2>Check reservations</h2>
            <ul class="noBullet">
                <li>
                    <select @change="showReservations" v-model="place_id" class="inputFields">
                        <option disabled value="">Please select one</option>
                        <option v-for="t in reservation" :key="t.id"
                                v-bind:value="t.id">{{t.name}} ( {{t.address}} )
                        </option>
                    </select>
                </li>
            </ul>

            <div v-if="place!=''">
                <p>Address: {{place.address}} | Size: {{place.size}}</p>
                <div v-if="place.reservations.data!=''">
                    <table id="customers">
                        <tr>
                            <th>Start Date</th>
                            <th>Finish Date</th>
                            <th>Time</th>
                        </tr>
                        <tr v-for="res in place.reservations.data" :key=res.id>
                            <td>{{res.start_date}}</td>
                            <td>{{res.end_date}}h</td>
                            <td>{{res.time}}h</td>
                        </tr>
                    </table>
                    <div class="page">
                        <pagination :data="place.reservations" @pagination-change-page="showReservations"
                                    :limit="2"></pagination>
                    </div>
                </div>
                <div v-else>
                    <p>There is no available reservations</p>
                </div>
            </div>
            <!-- <li v-for="user in reservation" v-bind:key="user.id">

                  {{ user.name }}

                </li> -->
        </form>
    </div>
</template>

<script>
    export default ({
        data: function () {
            return {
                reservation: [],
                place: [],
                place_id: ''
            }
        },
        mounted() {
            this.loadData();
        },
        methods: {
            loadData: function () {
                axios.get('api/places').then(res => {
                    if (res.status == 200) {
                        this.reservation = res.data;
                    }
                }).catch(err => {
                    console.log(err)
                });
            },
            showReservations: function (page = 1) {
                axios.get('api/places/' + this.place_id + '?page=' + page).then(res => {
                    if (res.status == 200) {
                        this.place = res.data;
                        console.log(this.place);
                    }
                }).catch(err => {
                    console.log(err)
                });
            }
        }
    })
</script>

<style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #443d3d;
    }

    #customers tr:hover {
        background-color: #ddd;
        color: black;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
    }

    .page-link {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #dee2e6;
    }

    .active {
        background-color: #fff;
    }

    .pagination {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: .25rem;
        margin: 5% 25%;
        justify-content: center;
    }

    .sr-only {
        display: none;
    }
</style>

