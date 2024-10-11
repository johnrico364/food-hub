"use client";
import Image from "next/image";
import { useRouter } from "next/navigation";

// Images
import Motto from "../images/utils/landing-motto.png";
import Logo from "../images/utils/logo.png";


export default function Home() {
  const router = useRouter();
  return (
    <div className="landing-page">
      <div className="wrapper">
        <div className="left-side">
          <div className="pt-8 pl-8">
            <Image src={Logo} height={25} alt="logo" />
          </div>

          <div className="wrapper motto-box">
            <div className="ml-16">
              <Image className="-mt-24" src={Motto} alt="motto" />
              <button
                className="cook-now-btn"
                onClick={() => router.push("/recipes")}
              >
                Cook Now
              </button>
            </div>
          </div>
        </div>
        <div className="right-side border"></div>
      </div>
    </div>
  );
}
