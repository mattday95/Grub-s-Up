import React, {Component} from 'react';
import {useSelector, connect} from 'react-redux';

import Header from '../objects/Header';
import {updatePostcode} from '../../redux/actions/';

class Home extends Component {

    constructor(props){
        super(props);
        this.state = {
            isUserActive: false,
            input : '',
            error : null
        }
    }

    isValidPostcode(postcode){
        const regex = new RegExp('^([A-Za-z][A-Ha-hJ-Yj-y]?[0-9][A-Za-z0-9]? ?[0-9][A-Za-z]{2}|[Gg][Ii][Rr] ?0[Aa]{2})$');
        return regex.test(postcode);
    }

    onChangeHandler(e){

        const input = e.target.value;

        if(this.isValidPostcode(input)){
            this.setState({
                error : false,
                isUserActive : true,
                input : input
            });
        }
        else {
            this.setState({
                error : true,
                isUserActive : true,
                input : input
            });
        }
    }

    handlePostcodeSubmit(e) {

        e.preventDefault();
        
        const {input} = this.state;

        if(this.isValidPostcode(input)){
            this.props.updatePostcode(input);
            this.props.history.push(`/list/${input}`);
        }

        else {
            this.setState({isUserActive : true, error : true});
        }
        
    }

    render() {

        return (
            <div class="o-hero">
                <div class="inner">
                    <h2>Order your favourite food online<br/><b>Get exclusive discounts!</b></h2>
                    <p style={{color: '#d82927'}}>{this.state.error && this.state.isUserActive && <span>Make sure you supply a valid UK postcode.</span>}</p>
                    <form class="c-postcode-search">
                        <input onFocus={() => this.setState({isUserActive : true})} onBlur={() => this.setState({isUserActive : false})} onChange={(e) => this.onChangeHandler(e)} type="text" placeholder="Write your postcode here..."></input>
                        <button onClick={(e) => this.handlePostcodeSubmit(e)} type="submit">Submit</button>
                    </form>
                </div>
            </div>
        )
    }
}

export default connect(null, {updatePostcode})(Home);