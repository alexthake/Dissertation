<template>
    <div class="container m-0">
        <div class="card my-3">
            <div type="button" class="card-body p-2">
                <div class="row mb-1">
                    <div class="col-10">
                        <h3>{{name}}</h3>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-light float-right">...</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <progress-bar
                        :progress="i" 
                        :time="j"></progress-bar>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProgressBar from './ProgressBar.vue';
    import moment from 'moment'

    export default{
        data: function() {
            var start = moment(this.created);
            var end = moment(this.due);
            var span = end.diff(start, "minutes");
            var position = moment().diff(start, "minutes");
            console.log();
            return{
                i: Math.floor((Math.random() * 100) + 1),
                j: Math.floor((position/span)*100)
            }
        },
        components: {
            ProgressBar
        },
        props: ['id', 'name', 'due', 'created'],
    }
</script>
