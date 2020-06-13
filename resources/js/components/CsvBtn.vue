<template>
    <div>
        <button v-on:click = "generateCsv"  v-bind:class="{ 'd-none': generateBtnHidden }" class="btn btn-secondary btn-block px-5 mb-5" type="button">Cгенерировать csv файл</button>
        <a v-bind:href="url" v-bind:class="{ 'd-none': downloadBtnHidden }" class="btn btn-info btn-block px-5 mb-5">Cкачать файл</a>
        <a href="https://github.com/DmitriyShaydurov/iforaTest" class="btn btn-info btn-block px-5 mb-5" target="_blank">Посмотреть код на GitHub</a>
        <a href="https://www.facebook.com/dmitriy.shaadow" class="btn btn-success btn-block px-5 mb-5" target="_blank">Посмотреть отзывы клиентов Д. Шайдурова </a>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                generateBtnHidden: false,
                downloadBtnHidden: true,
                url: '',
            }
        },


         methods: {
             generateCsv: function () {
                let hr = new XMLHttpRequest();
                let that = this;
                let url = "/generate-csv";

                hr.open("POST", url, true);
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                hr.onreadystatechange = function() {
                    let return_data = hr.responseText;
                    if(hr.readyState == 4 && hr.status == 200) {
                        console.log(return_data);
                        that.url = return_data;
                        that.generateBtnHidden = true;
                        that.downloadBtnHidden = false;
                        
                    }
                }
                hr.send(url);
            }
         }
    }
</script>
