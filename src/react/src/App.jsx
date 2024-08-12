import './App.css'
import Login from "./Views/Login/Login.jsx";
import {Route, Routes} from "react-router-dom";
import PaginaInicial from "./Views/PaginaInicial/PaginaInicial.jsx";
import Cadastro from "./Views/Cadastro/Cadastro.jsx";

function App() {

  return (
    <>
        <Routes>
            <Route path="/" element={<PaginaInicial/>}/>
            <Route path="/login" element={<Login/>}/>
            <Route path="/cadastro" element={<Cadastro/>}/>
        </Routes>
    </>
  )
}

export default App
