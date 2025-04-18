from socket import *

serverSocket = socket(AF_INET, SOCK_STREAM)
serverSocket.bind(("0.0.0.0", 14000))
serverSocket.listen(1) #max 1 connection

print("The server is ready to receive")

while True:
  connectionSocket, addr = serverSocket.accept()

  sentence = connectionSocket.recv(1024).decode()
  capitalizedSentence = sentence.upper()

  connectionSocket.send(capitalizedSentence.encode())
  connectionSocket.close()