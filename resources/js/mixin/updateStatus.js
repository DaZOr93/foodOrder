export default  {
    methods: {
        editStatus(event, id){
            this.updateStatusOrder({
                id : id,
                status : event.target.value
            })
        }
    },
    statusOption: [
        {
            value: "new",
            name: 'Новый',
        },
        {
            value: 'processing',
            name: 'В процессе',
        },
        {
            value: 'delivered',
            name: 'В доставке',
        },
        {
            value: 'completed',
            name: 'Выполнен',
        },
        {
            value: 'canceled',
            name: 'Отменен',
        },
    ],

}
