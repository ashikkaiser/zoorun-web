import React from 'react';
import ReactDOM from 'react-dom';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from "react-router-dom";
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import { Enterprise, Home, Courier, Login, Coverage, becomeAmerchant } from './pages/index';
import { Layout } from './components';

function Main() {
    return (

        <Router>

            <Switch>
                <Route exact path="/signin" component={Login} />
                <Route exact path="/login" component={Login} />
                <Layout>
                    <Route exact path="/" component={Home} />
                    <Route exact path="/enterprise" component={Enterprise} />
                    <Route exact path="/courier" component={Courier} />
                    <Route exact path="/coverage-area" component={Coverage} />
                    <Route exact path="/become-a-merchant" component={becomeAmerchant} />
                </Layout>



            </Switch>

        </Router>

        // <App />
    );
}


if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
