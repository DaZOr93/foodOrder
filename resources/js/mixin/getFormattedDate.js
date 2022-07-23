import moment from 'moment';
export default  {
    methods: {
        getFormattedDate(date) {
            return moment(date).format("DD-MM-YYYY hh:mm:ss")
        }
    }
}
