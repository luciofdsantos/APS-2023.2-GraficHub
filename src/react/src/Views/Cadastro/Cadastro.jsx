import "./Cadastro.css"
import {Link} from "react-router-dom";
export default function Cadastro(){
    return (
        <div className="main">
            <form action="">
                <Link to="/"><img className="logo-img" src="/img/logo.png" /></Link>
                <p className="title"> Cadastro </p>
                <input className="mainshadowdown" type="text" placeholder="Nome" required/>
                <input className="mainshadowdown" type="text" placeholder="Apelido" required/>
                <input className="mainshadowdown" type="email" placeholder="Email" required/>
                <input className="mainshadowdown" type="text" placeholder="Número de Telefone" required/>
                <input className="mainshadowdown" type="password" placeholder="Senha" required/>
                <input className="mainshadowdown" type="password" placeholder="Confirmar Senha" required/>
                <label className="mainshadowdown custom-file-upload" htmlFor="file-upload">Foto de Perfil</label>
                <input id ="file-upload" type="file" placeholder="Foto de Perfil" />
                <button className="btn btn-block mainshadowdown">Cadastrar</button>
                <p className="message">Ja possui conta? <Link to="/login">Faça login</Link></p>
            </form>
        </div>
    )
}
