const postcodeReducer = (state = '', action) => {

    switch(action.type){
        case 'UPDATE_POSTCODE':
            return action.payload;
        default:
            return state;
    }

}

export default postcodeReducer;