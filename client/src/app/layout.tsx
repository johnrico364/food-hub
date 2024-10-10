import "./globals.css";
import './global-components.css';

export const metadata = {
  title: "Food Hub",
  description: "Cook all you want!",
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body>{children}</body>
    </html>
  );
}
