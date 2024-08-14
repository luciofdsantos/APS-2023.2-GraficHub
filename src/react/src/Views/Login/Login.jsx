import "./Login.css"
import {Link} from "react-router-dom";

export default function Login(){
    return (
    <div className="main">
        <form action="">
            <Link to="/"><img className="logo-img" src="/img/logo.png" /></Link>
            <p className="title"> Login </p>
            <input className="mainshadowdown" type="email" placeholder="Email" required/>
            <input className="mainshadowdown" type="password" placeholder="Password" required/>
            <button  className="btn btn-block mainshadowdown">Login</button>
            <p className="message">Não possui uma conta? <Link to="/cadastro">Cadastre-se</Link></p>
            </form>
    </div>
    )
}
