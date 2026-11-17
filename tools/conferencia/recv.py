# Recebe os renders que o navegador manda (porta 8799) e grava em _ref/incom/renders.
# Uso: python3 tools/conferencia/recv.py _ref/incom/renders
import http.server, base64, json, os, sys, urllib.parse
OUT = sys.argv[1]
class H(http.server.BaseHTTPRequestHandler):
    def _cors(self):
        self.send_header('Access-Control-Allow-Origin', '*'); self.send_header('Access-Control-Allow-Headers', '*'); self.send_header('Access-Control-Allow-Methods', 'POST, OPTIONS')
    def do_OPTIONS(self):
        self.send_response(204); self._cors(); self.end_headers()
    def do_POST(self):
        q = urllib.parse.parse_qs(urllib.parse.urlparse(self.path).query); name = os.path.basename(q.get('name', ['x'])[0])
        body = self.rfile.read(int(self.headers.get('Content-Length', 0))).decode()
        if body.startswith('data:'):
            open(os.path.join(OUT, name + '.jpg'), 'wb').write(base64.b64decode(body.split(',', 1)[1]))
        else:
            open(os.path.join(OUT, name + '.json'), 'w').write(body)
        self.send_response(200); self._cors(); self.end_headers(); self.wfile.write(b'ok')
    def log_message(self, *a): pass
http.server.HTTPServer(('127.0.0.1', 8799), H).serve_forever()
