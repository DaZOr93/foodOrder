import axios from 'axios';


const config = {

    headers: {

        "content-type": "application/json",
    }
}

const axiosInstance = axios.create(config);

export {
    axiosInstance
}
