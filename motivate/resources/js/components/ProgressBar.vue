<template>
    <div class="progress position-relative">
        <div :class="'progress-bar '+ ((progress == 100) ? 'bg-success' : '')" role="progressbar" :style="'width: '+progress+'%;'" :aria-valuenow="progress+'%'" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="position-absolute progress-timemark" :style="'left: '+time+'%;'"></div>
    </div>
</template>

<script>
    export default {
        props: {
            progress: Number,
            time: Number
        }
    }
</script>

<style>
    .progress-timemark{
        top: 0;
        width: 1px;
        height: 100%;
        background-color: black;
    }
</style>