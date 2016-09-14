import Chart from 'chart.js';

export default{
    template: '<div class="col-lg-10 col-lg-offset-1">' +
                '<canvas v-el:canvas></canvas>' +
              '</div>',

    props: {
        url: {}
    },

    data(){
        return {
            chart: ''
        }
    },

    ready(){
        this.load();
    },

    methods:{
        load(){
            this.fetchData().then(
                response => this.render(response.data)
            );
        },

        fetchData(){
            return this.$http.get(this.url);
        },

        render(data){
            console.log(data);
            console.log(Object.keys(data).map(key => data[key]));
            var conteudo = {
                labels: [Object.keys(data)],
                datasets: [
                    {
                        label: "Alerta",
                        backgroundColor: "rgba(255,99,132,0.2)",
                        borderColor: "rgba(255,99,132,1)",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(255,99,132,0.4)",
                        hoverBorderColor: "rgba(255,99,132,1)",
                        data: Object.keys(data).map(key => data[key].alert)
                    },
                    {
                        label: "Informação",
                        backgroundColor: "rgba(20, 94, 168,0.2)",
                        borderColor: "rgba(20, 94, 168,1)",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(20, 94, 168,0.4)",
                        hoverBorderColor: "rgba(20, 94, 168,1)",
                        data: Object.keys(data).map(key => data[key].info)
                    },
                    {
                        label: "Notícia",
                        backgroundColor: "rgba(0,150,132,0.2)",
                        borderColor: "rgba(0,150,132,1)",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(0,150,132,0.4)",
                        hoverBorderColor: "rgba(0,150,132,1)",
                        data: Object.keys(data).map(key => data[key].notice)
                    },
                    {
                        label: "Aviso",
                        backgroundColor: "rgba(255, 145, 0,0.2)",
                        borderColor: "rgba(255, 145, 0,1)",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(255, 145, 0,0.4)",
                        hoverBorderColor: "rgba(255, 145, 0,1)",
                        data: Object.keys(data).map(key => data[key].warning)
                    }
                ]
            };

            var contexto = this.$els.canvas.getContext('2d');

            new Chart(contexto, {
                type: 'bar',
                data: conteudo,
                options:{
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                stacked: true,
                                beginAtZero: true,
                                min:0
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                min:0
                            }
                        }]
                    }
                }
            });
        }
    }
}