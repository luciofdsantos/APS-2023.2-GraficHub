import "./Login.css"

export default function Login(){
    return (
    <div className="main">
        <form action="">
            <p className="title"> Login </p>
            <input className="mainshadowdown" type="email" placeholder="Email" required/>
            <input className="mainshadowdown" type="password" placeholder="Password" required/>
            <button  className="btn btn-block mainshadowdown">Login</button>
            <p className="message">Not Registered?</p>
            </form>
    </div>
    )
}
