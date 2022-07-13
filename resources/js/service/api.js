import axios from 'axios';


const config = {
    withCredentials : true,
    headers: {

        "content-type": "application/json",
    }
}

const axiosInstance = axios.create(config);

export {
    axiosInstance
}
