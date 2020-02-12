<template>
    <header class="header">
        <h1>Reservation System</h1>
        <div id="nav">
            <router-link to="/">Create Reservation</router-link>
            |
            <router-link to="/reservations">Check Reservation</router-link>
        </div>
    </header>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>
    .header {
        background: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
    }

    .header a {
        color: #fff;
        padding-right: 5px;
        text-decoration: none;
    }
</style>
