import "./NavBar.css"
import {Link} from "react-router-dom";

export default function NavBar(){
    return (
    <header className="nav-bar-wrapper mainshadowdown">
        <div className="logo-wrapper">
            <Link to="/">
                <img className="logo-img" src="/logo.png" alt="grafic hub logo"/>
                <img className="logo-text-img" src="/logo_text.png" alt="grafic hub logo"/>
            </Link>
        </div>
        <div className="picture-wrapper">
            <Link to="/login"><img className="profile-ima" src="/profile-img.png" alt="profile pic" /> <div>Entrar/Cadastrar</div></Link>
        </div>
    </header>
    )
}
