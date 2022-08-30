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
import { Enterprise, Home, Courier, Login, } from './pages/index';
import { Layout } from './components';

function Main() {
    return (

        <Router>



            <Switch>
                <Layout>
                    <Route exact path="/" component={Home} />
                    <Route exact path="/enterprise" component={Enterprise} />
                    <Route exact path="/courier" component={Courier} />
                </Layout>
                <Route exact path="/signin" component={Login} />
            </Switch>

        </Router>

        // <App />
    );
}


if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
