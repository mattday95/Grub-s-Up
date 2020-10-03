import { combineReducers } from 'redux';

import postcodeReducer from './postcode';

const rootReducer = combineReducers({
    postcode : postcodeReducer
});

export default rootReducer;